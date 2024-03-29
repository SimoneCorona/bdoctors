# BDoctors

## Descrizione
BDoctors è una applicazione web che permette agli utenti di prenotare appuntamenti con medici. Gli utenti possono cercare medici in base alla specializzazione o alla località e visualizzare le informazioni relative al medico selezionato, inclusi i dettagli della sua formazione e gli orari di disponibilità. Gli utenti possono prenotare una visita selezionando una data e un orario disponibile.

## Funzionalità
- Registrazione degli utenti: gli utenti possono creare un account utilizzando un indirizzo email valido e una password.
- Login degli utenti: gli utenti possono accedere al proprio account utilizzando l'indirizzo email e la password.
- Cancellazione degli account: gli utenti possono eliminare il proprio account se non desiderano più utilizzare l'applicazione.
- Ricerca di medici: gli utenti possono cercare i medici in base alla specializzazione o alla località.
- Visualizzazione delle informazioni del medico: gli utenti possono visualizzare i dettagli del medico selezionato, inclusi i dettagli della formazione e gli orari di disponibilità.
- Prenotazione di appuntamenti: gli utenti possono prenotare un appuntamento selezionando una data e un orario disponibile.

## Requisiti di sistema
- Node.js
- MongoDB

## Configurazione
1. Clonare il repository: `git clone https://github.com/tahakyo/bdoctors.git`
2. Installare le dipendenze: `npm install`
3. Creare un file `.env` nella directory principale e configurare le seguenti variabili d'ambiente:
   - `DB_CONNECTION`: URL di connessione al database MongoDB
   - `JWT_SECRET`: Chiave segreta per la generazione dei token JWT
   - `EMAIL_USERNAME`: Indirizzo email per l'invio delle notifiche
   - `EMAIL_PASSWORD`: Password dell'indirizzo email
   - `EMAIL_HOST`: Host SMTP per l'invio delle email
   - `EMAIL_PORT`: Porta SMTP per l'invio delle email
4. Avviare l'applicazione: `npm start`


## Risorse utilizzate
- Node.js: ambiente di runtime JavaScript per il server-side
- Express.js: framework per la creazione di applicazioni web
- MongoDB: sistema di gestione di database NoSQL
- Mongoose: modulo di ODM (Object-Document Mapping) per l'interazione con MongoDB
- Passport.js: middleware per l'autenticazione utente
- JWT: per la generazione e verifica dei token JWT
- Nodemailer: modulo per l'invio di email
- Bootstrap: framework CSS per la creazione di interfacce utente responsive
