# school-admission

## Here are the steps on how to get started:

1. Clone the repository to their computer.
2. Activate the virtual environment.
3. Install the required Python packages.
4. Run Django.

## Clone this repository on your computer
1. Go to the GitHub repository that you want to clone.
2. Click on the "Code" button on the right side of the page.
3. Click on the HTTPS option to copy the repository URL.
4. Open a terminal or command prompt and navigate to the directory where you want to clone the repository.
5. Run the following command to clone the repository:
    ```
    git clone <repository-url>
    ```
6. Replace <repository-url> with the URL you copied in step 3.
7. When prompted, enter your GitHub username and password to authenticate.
8. Once the repository is cloned, you can navigate to the cloned directory and start set up the environment.

## Activate the environment
1. Check if pip is already installed: Open a command prompt or terminal and type the following command:
   ```
   pip --version
   ```
   If pip is installed, it will display the version number. If not, you will see an error message.
2. Install or upgrade pip using the official installation script: Open a command prompt or terminal, and run the following command:
    ```
    curl https://bootstrap.pypa.io/get-pip.py -o get-pip.py
    ```
3. Once the script is downloaded, run the following command to install or upgrade pip:
    ```
    python get-pip.py
    ```
    This command will execute the script and install or upgrade pip accordingly. Make sure you have administrative privileges if you're on a system that requires it.

4. Verify the installation: After the installation process completes, you can verify that pip is installed correctly by running the following command:
    ```
    pip --version
    ```
    It should now display the version number, indicating that pip is installed and ready to use.
5. Activate the environment
    ```
    school-admission\Scripts\activate.bat
    ```
## Install the required Python packages
1. Install Django
   ```
   python -m pip install Django
   ```
