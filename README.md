Projeto Lyla
=================

O Projeto Lyla é software que utiliza o poder das redes sociais (Facebook e Twitter) para divulgar os dados de pessoas desaparecidas.  

Como funciona
-------------------

O Facebook e Twitter disponibilizam tokens de acesso às contas de usuário que duram 'eternamente'. Quando o usuário se cadastra no Lyla, eu pego um desses tokens, armazeno e utilizo a qualquer momento depois, dependendo da necessidade do sistema.
Durante dois momentos do dia, aciono um arquivo chamado cerebro.class.php, que fica fora do public_html, através de cronjob, e ele pega os desaparecidos registrados e sincroniza com os tokens, utilizando lógicas diferentes dependendo do número de tokens e desaparecidos disponível, tudo explicado nos comentários do arquivo.
Mas é mais ou menos assim: a cada execução, todos os tokens são utilizados uma vez somente. Se tiver mais tokens que desaparecidos, alguns desaparecidos serão anunciados mais de uma vez. Se tiver menos tokens, o máximo possível de desaparecidos serão anunciados e o sistema registrará a partir de qual 'parou' o anúncio, ou seja, em qual desaparecido os tokens acabaram. Na próxima execução, tudo começará a partir dele. Se token = desaparecidos, aí é a situação mais simples :)

Existe também um sistema simples de gerenciamento dos perfis de desaparecidos.
 

ToDo
-----------

- Tive sérios problemas com path no sistema. Transitei por três servers e cada um apresentava um cenário diferente. Resultado: Um 'leve' workaround para passar por cima do problema. Dessa forma, existem dois autoload.php (mas creio que, na situação atual, somente um é referenciado), e ele está bem feio. Preciso arrumar isso. Vários arquivos contêm um 'set_include_path(" .... ");', que deve ser arrumado.

- O Facebook desabilitou a utilização de tokens 'eternos'. O máximo que pode ser feito são tokens que duram *muito* tempo (cerca de dois meses). É necessário trabalhar com essa nova realidade, mandando um e-mail para o usuário renovar o token, quando estiver acabando, registrar a timestamp de quando foi registrado e verificar se ainda é válido.

- Melhorar o autoload.php. Utilizei a estrutura de whitelist listando manualmente todos os arquivos a serem inseridos, mas agora creio ser mais inteligente usar uma função que determine uma regra de nomenclatura para os arquivos a serem inseridos. Lembrar de nunca deixar a segurança de lado.

- O layout de algumas páginas de gerenciamento ainda não está pronto.


Outras explicações
---------------------------

Não utilizei nenhum Framework, e está no modelo MVC, apesar de eu não ter integrado nenhuma template engine.  
Já no Banco de Dados, a tabela que contem as informaçõs dos desaparecidos é `desap`. O arquivo que lida com as requisições de rede social é o lib/socialservice.class.php . O arquivo que contém o algoritmo de distribuição das informações de desaparecidos é lyla/cerebro.class.php. 
Os arquivos que fazem a coleta de access_tokens são lyla/public_html/auth_fb_direct.php e lyla/public_html/auth_twitter_direct.php  

*Forma de trabalho do sistema:*
 
O usuário cede os tokens em auth_fb_direct.php ou auth_twitter_direct.php. O sistema pega o token e coloca no BD. O cerebro.class.php pega os tokens, os desaparecidos e tenta distribuir de forma equilibrada entre eles. Naturalmente, é mais comum existirem mais desaparecidos que tokens, dessa forma o cerebro.class.php não fica importunando o usuário utilizando seu token mil vezes, e sim o utiliza uma vez, cadastra em qual desaparecido parou, e na próxima iteração (horas depois), parte de onde parou, até que todos os desaparecidos sejam cobertos.
