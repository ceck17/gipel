GIPel : Gestionnaire d'Informations Personnelles en ligne

Licence :
=========

Vous pouvez copier, modifier cette
source, dans les conditions fixées par la licence, tant que cette note
apparait clairement.

Description :
=============

Cette application vous permet d'accéder, de gérer et de partager toutes vos précieuses 
informations en toute sécurité, à tout moment et en tout lieu. Elle
 utilise le fameux framework CodeIgniter 2.1.4.
Elle contient un carnet d'adresses, un bloc-notes, un répertoire pour vos documents et un gestionnaire d
'identifiants et mots de passe pour vos sites web
Un moteur de recherche vous permet de retrouver rapidement vos enregistrements par leurs « mot
s clé », en seulement 2 clics. Ce moteur est toujours accessible dans le bandeau supérieur.
L'accès aux informations contenues dans GIPel nécessite une 
authentification stricte. La sécurité n'a pas été négligée. Les sessions sont 
gérées par la classe « session » de codeigniter et enregistrées dans la base de données. Leur durée est limitée. 
Les informations sensibles, elles, sont invisibles dans le cookie de session.

GIPel est capable de gérer 3 types d'utilisateurs : 
1 - ReadOnly (Lecture seule), 
2 - ReadWrite (Lecture et écriture),
3 - SuperAdmin (administrateur unique du site).

ReadOnly peut :
- accéder aux sections : enregistrements, divers
- afficher les enregistrements « communautaires »

ReadWrite peut, en plus :
- afficher les enregistrements « personnels » lui appartenant
- ajouter des enregistrements « personnels » ou « communautaires »
- éditer et supprimer les enregistrements « personnels » lui appartenant

SuperAdmin peut, en plus :
- accéder aux sections : administration et gestion bancaire
- afficher tous les enregistrements « personnels »
- éditer et supprimer tous les enregistrements « personnels » ou « communautaires »
- gérer les groupes d'enregistrements

Les enregistrements se déclinent en 2 niveaux de confidentialité :
- communautaires : visibles par tous les utilisateurs une fois qu'ils sont authentifiés
- personnels : visibles uniquement par le propriétaire (et l'administrateur

Des efforts ont été faits, notamment au niveau de la navigation, pour
 que GIPel soit utilisable facilement à partir de téléphones portables, même
 de bas de gamme. Posez le doigt sur un numéro de téléphone que vous avez enregistré
dans GIPel : votre portable composera automatiquement le numéro. Pour 
les sites web, copiez et collez facilement vos mots de passe... Et n'oubliez pas
 de mettre un mot de passe de déverrouillage sur votre i-phone !
Enfin, une procédure d'installation détaillée ainsi qu'un script dédié rendent 
l'installation très facile, même si vous n'êtes pas un expert de l'informatique. 
Il vous suffit d'un serveur pour héberger l'application.

Procédure d'installation : 
<a href='http://www.ceck-org.i17.fr/applications-web/gipel/installer-gipel/' 
rel='noopener noreferrer ugc nofollow' target='_blank'>
http://www.ceck-org.i17.fr/applications-web/gipel/installer-gipel/</a>

Url de la démo : <a href='http://webapps.i17.fr/gipel/index.php/home/lo
gin' rel='noopener noreferrer ugc nofollow' target='_blank'>http://webapps.i17.fr/gipel/index.php/home/login</a>

Url du projet : <a href='http://
www.ceck-org.i17.fr/applications-web/gipel/' rel='noopener noreferrer ugc nofoll
ow' target='_blank'>http://www.ceck-org.i17.fr/applications-web/gipel/</a>
