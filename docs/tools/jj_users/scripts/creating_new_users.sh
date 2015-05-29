#!/bin/bash

# Creating the permissions
../cake/console/cake jj_users.jodel_new_user permission_add "Ver rascunhos" view_drafts
../cake/console/cake jj_users.jodel_new_user permission_add "Dashboard" dashboard
../cake/console/cake jj_users.jodel_new_user permission_add "Bastidores" backstage
../cake/console/cake jj_users.jodel_new_user permission_add "Visualizacao de itens" backstage_view_item
../cake/console/cake jj_users.jodel_new_user permission_add "Edicao de itens em rascunho" backstage_edit_draft
../cake/console/cake jj_users.jodel_new_user permission_add "Exclusao de itens" backstage_delete_item
../cake/console/cake jj_users.jodel_new_user permission_add "Mudar status (rascunho/publicado)" backstage_edit_publishing_status
../cake/console/cake jj_users.jodel_new_user permission_add "Edicao de itens publicados" backstage_edit_published
../cake/console/cake jj_users.jodel_new_user permission_add "Lista de usuarios" user_list
../cake/console/cake jj_users.jodel_new_user permission_add "Adicao de usuarios" user_add
../cake/console/cake jj_users.jodel_new_user permission_add "Edicao de usuarios" user_edit
../cake/console/cake jj_users.jodel_new_user permission_add "Exclusao de usuarios" user_delete
../cake/console/cake jj_users.jodel_new_user permission_add "Arvore de permissoes" user_permission_tree
../cake/console/cake jj_users.jodel_new_user permission_add "Envio de e-mail" la_poste


# Creating the profiles
../cake/console/cake jj_users.jodel_new_user profile_add "Tecnico" techie
../cake/console/cake jj_users.jodel_new_user profile_add "Cartas / E-mail" mailman

# Creating the relations
../cake/console/cake jj_users.jodel_new_user profile_permission techie view_drafts dashboard backstage backstage_view_item backstage_edit_draft backstage_delete_item backstage_edit_publishing_status backstage_edit_published user_list user_add user_edit user_delete user_permission_tree
../cake/console/cake jj_users.jodel_new_user profile_permission mailman la_poste

# Creating the users
../cake/console/cake jj_users.jodel_new_user add "Super-usuario" preface@preface.com.br "123456" techie


# Adding permission to profiles
# ./cake jodel_new_user profile_permission_add "profile_wanted" new_permission_to_add

# Adding profiles to users
# ./cake jodel_new_user user_profile_add "preface@preface.com.br" profile_wanted
