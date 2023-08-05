# school_admission

## Here are the steps on how to get started:

### 1. Install the latest Python on your machine
- **Method 1:** Download the installer from the Python website: Go to the Python website: https://www.python.org/downloads/ and click on the Download Python button. You will be prompted to choose a version of Python and a download method. Once you have chosen a version and a download method, the installer will be downloaded to your computer.
- **Method 2:** Install Python using the Microsoft Store: If you are using Windows, you can install Python using the Microsoft Store. To do this, open the Microsoft Store and search for "Python." Click on the Python app and then click on the Install button.
### 2. Create the virtual environment
    python -m venv myenv
### 5. Activate the virtual environment
- **Windows:**
    ```
    myenv\Scripts\activate
    ```
- **Mac/Linux:**
    ```
    source myenv/bin/activate
    ```
### 6. Clone the repository inside your env
    git clone <repository_url>
### 7. Install project dependencies
Navigate to the project's root directory (the one containing manage.py). Use pip to install the project dependencies by running:

    pip install -r requirements.txt
This command will install all the necessary packages specified in the requirements.txt file.
### 7. Set up the database
    python manage.py migrate
### 8. Start the development server
    python manage.py runserver

Hope everything works great!
