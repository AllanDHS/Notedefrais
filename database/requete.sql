SELECT employes.id AS id_employes, employes.firstname AS firstname_employes,employes.lastname AS lastname_employes,email_adress AS employe_email, status_note.name AS status_note, type_de_frais.name AS type_de_frais  
FROM renseignement_frais
INNER JOIN type_de_frais ON renseignement_frais.id_type_de_frais = type_de_frais.id
INNER JOIN status_note ON renseignement_frais.id_status_note = status_note.id
INNER JOIN employes ON renseignement_frais.id_employes = employes.id
WHERE renseignement_frais.id_employes = 3;