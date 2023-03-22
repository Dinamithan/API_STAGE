# API_STAGE

* Récupérer le dépot : git clone https://github.com/Dinamithan/API_STAGE.git

* Ajouter les dépendances requises :
composer require symfony/maker-bundle --dev
composer require symfony/apache-pack
composer require doctrine/annotations
composer require orm
composer require symfony/serializer-pack
composer install


## Les routes : 

Route : GET /api/student
Cette route retourne la liste des étudiants. Aucun paramètre n'est requis. La réponse est au format JSON et contient les détails de chaque étudiant, tels que leur nom, leur adresse e-mail et leur âge.

Route : POST /api/student
Cette route permet de créer un nouvel étudiant. Les paramètres requis sont name, email et age, qui doivent être fournis dans le corps de la requête au format JSON. Si la création réussit, la réponse sera un code de statut 201 (Créé) et le corps de la réponse contiendra les détails de l'étudiant créé.

Route : GET /api/company
Cette route retourne la liste des entreprises. Aucun paramètre n'est requis. La réponse est au format JSON et contient les détails de chaque entreprise, tels que leur nom, leur adresse e-mail et leur secteur d'activité.

Route : POST /api/company
Cette route permet de créer une nouvelle entreprise. Les paramètres requis sont name, email et sector, qui doivent être fournis dans le corps de la requête au format JSON. Si la création réussit, la réponse sera un code de statut 201 (Créé) et le corps de la réponse contiendra les détails de l'entreprise créée.

Route : GET /api/internship
Cette route retourne la liste des stages disponibles. Aucun paramètre n'est requis. La réponse est au format JSON et contient les détails de chaque stage, tels que leur titre, leur description et leur rémunération.

Route : POST /api/internship
Cette route permet de créer un nouveau stage. Les paramètres requis sont title, description et pay, qui doivent être fournis dans le corps de la requête au format JSON. Si la création réussit, la réponse sera un code de statut 201 (Créé) et le corps de la réponse contiendra les détails du stage créé.

## Documentation des routes en JSON : https://github.com/Dinamithan/API_STAGE/blob/main/Documentation.
