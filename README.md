# Complaint Management System (FYP)

Final year project: a web-based complaint management system for a facility or campus, where complaints are filed, routed to the right technician, and tracked through to resolution. A TensorFlow text classifier sorts incoming complaints into a category automatically.

## What it does

- **Complaint handling.** Complainants register complaints and follow their history. Admins create, view and manage complaints and technicians.
- **Role-based dashboards.** Separate controllers and views for each role: Admin, Complainant, Technician, Purchaser, Store Manager and Treasurer.
- **Material requests.** Requested products are handled by the store manager and purchaser (pending, requested and issued views), and admins can track each material request.
- **Accidental reports.** Admins can create incident reports; the admin and treasurer dashboards both list and view them.
- **Technician performance.** Admins can view per-technician performance and history.
- **Automatic categorisation.** `CMS_MODEL.py` takes the text of a complaint and predicts one of: Civil, Electrical, Furniture, HVAC, IT, Mechanical, Plumbing, Surveillance.
- **Google Calendar integration.** Example scripts (`quickstart.php`, `c.php`) read and create calendar events through the Google API client.

## Tech stack

| Part | Technology |
|---|---|
| Web app | PHP, CodeIgniter 3 (MVC) |
| Database | MySQL (dump in `database/`) |
| Front end | HTML, CSS/SCSS, JavaScript admin template |
| Classifier | Python, TensorFlow/Keras, pandas, NLTK |
| Integrations | Google API PHP client (`google/apiclient`) |

## Repository layout

```
application/      CodeIgniter controllers, models, views (per-role)
system/           CodeIgniter core
assets/           Front-end assets (assets.zip is the packed copy)
database/         MySQL dump of the schema and sample data
CMS_MODEL.py      Complaint classifier (loads model_file.h5)
model_file.h5     Trained Keras model
CMS_Complaints.csv  Complaint text used to rebuild the tokenizer
quickstart.php, c.php  Google Calendar API examples
```

## Setup

### Web app

1. Install PHP and MySQL (XAMPP or similar works).
2. Run `composer install` in the project root.
3. Create a database and import `database/kagone_appdemo-fyp.sql`.
4. Put your database settings in `application/config/database.php`.
5. Point your web server at the project root and open it in a browser.

### Complaint classifier

```
pip install tensorflow pandas numpy nltk
python -c "import nltk; nltk.download('stopwords')"
python CMS_MODEL.py "water is leaking from the ceiling in room 12"
```

The script prints the predicted category. Run it from the repo root so it can find `CMS_Complaints.csv` and `model_file.h5`.

### Google Calendar (optional)

Create your own Google Cloud credentials and keep them out of version control. Do not reuse or commit credential files.

## License

MIT. CodeIgniter is licensed separately, see `license.txt`.
