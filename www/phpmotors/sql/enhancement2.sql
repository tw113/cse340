INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment)
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman')

UPDATE clients
SET clientLevel = '3'
WHERE clientId = 2

UPDATE inventory
SET invDescription = Replace(invDescription, 'small interiors', 'spacious interior')
WHERE invId = 12

SELECT invModel
FROM inventory AS i
INNER JOIN carclassification AS c ON i.classificationId = c.classificationId
WHERE c.classificationName = 'SUV'

DELETE FROM inventory
WHERE invId = 1

UPDATE inventory
SET invImage = Concat('/phpmotors', invImage), invThumbnail = Concat('/phpmotors', invThumbnail)