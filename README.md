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

Refatoração total do Projeto Lyla para adequação e padronização dos códigos.