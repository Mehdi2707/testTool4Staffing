# Test technique Tool4Staffing

L'accès au module Garages doit être accessible seulement pour le clientb.
Afin de restreindre l'accès à certains modules 'premium' il faut vérifier en back et en front si le client à l'autorisation d'accéder à cette fonctionnalité.
Voici ce qui est fait actuellement en front : 
```
const accessibleModules = {
        clienta: ['cars'],
        clientb: ['cars', 'garages'],
        clientc: ['cars']
};
if (!accessibleModules[client]?.includes(module)) {
    console.warn(`Le client ${client} n'a pas accès au module ${module}. Redirection vers Cars.`);
    module = 'cars';
    script = 'list';
}
```

On indique les droits d'accès aux clients puis on redirige si le client n'a pas accès.
En back on vérifie simplement le client dans le cookie et on renvoie une 403 si l'accès n'est pas autorisé : 
```
$client = $_COOKIE['client'] ?? '';
if ($client !== 'clientb') {
    http_response_code(403);
    exit;
}
```

Lors de la récupération des données pour éviter les injections XSS il est nécessaire d'échapper les données avec 'htmlspecialchars' par exemple.

Le clienta peut toujours accéder aux données du clientb par exemple sans pour autant changer de cookie.
Pour résoudre cela il est nécessaire de contrôler le cookie en back et de rejeter l'utilisateur s'il n'est pas le client courant.
Par exemple je suis clienta et je tente d'accéder aux données de clientb : 
```
if ($client !== 'clientb') {
    http_response_code(403);
    exit;
}
```

Les cookies sont facilement manipulables, afin de renforcer la sécurité on pourrait ajouter une session côté serveur par exemple : 
```
session_start();
if (!isset($_SESSION['client']) || $_SESSION['client'] !== 'clientb') {
    http_response_code(403);
    exit;
}
```

Enfin, selon moi la meilleure façon de sécuriser les données pour chaque client et d'ajouter une couche d'authentification avec un token par exemple.
Les frameworks modernes comme Symfony permet de faire cela rapidement et de donner des droits à certains utilisateurs tout en évitant les injections SQL.
