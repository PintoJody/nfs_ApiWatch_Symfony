# nfs_ApiWatch_Symfony

## Requetes pour les montres 

### Préfixe global
`/api/watch`

- Afficher la liste de tous les items :
`/show`
- Afficher un item seul :
`/show/{id}`
- Supprimer un item :
`/delete/{id}`

#### Création et modification de montre
- Créer un nouvel item :
`/new`
- Modifier un item :
`/edit/{id}`

Les paramètres attendues :

- name
- shortDescription
- description
- price
- note
- color
- gps (boolean)
- size
- bluetooth (boolean)
- weight
- picture (url)

## Requetes pour les users

### Préfixe global
`/api/user`

- Connexion :
`/login`
Les paramètres attendues :
{
    'email': '',
    'password': ''
}

- Ajouter un utilisateur :
`/registration`

Les paramètres attendues :
- email
- password
