SELECT employes.id AS id_employes, employes.firstname AS firstname_employes,employes.lastname AS lastname_employes,email_adress AS employe_email, type_de_frais.name AS type_de_frais,type_de_frais.id AS id_type_de_frais,status_note.name AS status_note,status_note.id AS status_id,renseignement_frais.id AS id_note,renseignement_frais.payment_date AS Date_de_la_note,renseignement_frais.payment_amount AS amount_payment,renseignement_frais.validate_date AS validation_date,renseignement_frais.reason_payment AS reason_payment 
FROM renseignement_frais
INNER JOIN type_de_frais ON renseignement_frais.id_type_de_frais = type_de_frais.id
INNER JOIN status_note ON renseignement_frais.id_status_note = status_note.id
INNER JOIN employes ON renseignement_frais.id_employes = employes.id
WHERE renseignement_frais.id_employes = 3;