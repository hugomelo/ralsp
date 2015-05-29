#!/bin/bash

# Creating the groups
./cake jodel_user group_add "Todos os usuários" all_users -no-parent
./cake jodel_user group_add "Administradores" admin all_users
./cake jodel_user group_add "Editores" editors admin
./cake jodel_user group_add "Redatores" redactors admin
./cake jodel_user group_add "Técnicos" techies admin
./cake jodel_user group_add "Superusuarios" superusers admin
./cake jodel_user group_add "Usuários do site" sui_users all_users

# Creating the users
./cake jodel_user add "Lucas Vignoli" lucas@preface.com.br "1234" techies
./cake jodel_user add "Daniel Abrahao" daniel@preface.com.br "1234" techies
./cake jodel_user add "Hugo Melo" hugo@preface.com.br "1234" techies
./cake jodel_user add "Super-usuario" preface@preface.com.br "1234" superusers
./cake jodel_user add "Teste de Redator" redator@preface.com.br "1234" redactors



#Creating the acos tree
#The tree to be created:
#
#public_page
#backstage_area
#	new_news
#page_sections_test
#	section_one
#	section_two
#		section_two_one


./cake acl create aco root all_pages
./cake acl create aco all_pages public_page
./cake acl create aco all_pages backstage_area
./cake acl create aco backstage_area new_news
./cake acl create aco all_pages page_sections_test
./cake acl create aco page_sections_test section1
./cake acl create aco page_sections_test section2
./cake acl create aco section2 section21
./cake acl create aco public_page view_drafts
./cake acl create aco backstage_area login_as_sui

#granting permission
./cake acl grant all_users public_page all
./cake acl grant editors backstage_area all
./cake acl grant redactors backstage_area all
./cake acl grant techies backstage_area all
./cake acl grant superusers all_pages all
./cake acl grant admin view_drafts all

./cake acl deny editors login_as_sui all
./cake acl deny redactors login_as_sui all
./cake acl grant techies login_as_sui all
