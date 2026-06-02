# Document Tracker System

The Document Tracker System is a web-based application designed to streamline the management, monitoring, and tracking of documents within an organization. It enables users to efficiently record, organize, and track the status and movement of documents from submission to completion.

The system provides real-time visibility into document workflows, helping reduce delays, prevent document loss, and improve overall operational efficiency. Users can easily search, update, and monitor document records while administrators can oversee document activities and generate reports when needed.

## Key Features

* Document registration and tracking
* Real-time status updates
* Document search and filtering
* User authentication and role management
* Activity logs and tracking history
* Dashboard for monitoring document progress
* Secure storage and management of document records

## Purpose

This project aims to improve document handling processes by providing a centralized platform that ensures transparency, accountability, and efficient document management within an organization.


## 🚀 Getting Started

This project uses a lean, vanilla frontend stack (HTML, CSS, JS) with Tailwind CSS v4. To run the build tools and compile the styles locally, you will need to have Node.js installed.

### 1. Prerequisites
Before you begin, ensure you have **Node.js** installed on your machine (which includes `npm`).
* Download and install the LTS version from the [official Node.js website](https://nodejs.org/).
* To verify the installation, open your terminal and run:
  ```bash
  node -v
  npm -v
(Both commands should return a version number. If they are not recognized, restart your terminal or computer.)

2. Installation
Clone the repository and install the project's development dependencies (specifically the Tailwind CSS CLI).

Bash
# Clone the repository
git clone [https://github.com/Paoxyz/Document_tracker.git](https://github.com/Paoxyz/Document_tracker.git)

# Navigate into the project directory
cd Document_tracker

# Install the required Node modules
npm install
Note: The node_modules folder is ignored by Git, which is why you must run npm install to download Tailwind fresh on any new machine.

3. Running the Development Server
To work on the project and have Tailwind automatically compile your utility classes as you code, you need to run the build watcher.

Open your terminal in the project directory and run:

Bash
npx @tailwindcss/cli -i ./src/input.css -o ./public/assets/css/style.css --watch
Leave this terminal running in the background. It will actively watch your files and update the style.css file whenever you save changes.

4. Viewing the Project
Once the watcher is running, simply open public/index.html in your web browser, or use a tool like VS Code's Live Server extension to view the site with hot-reloading.
