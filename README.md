# Buckhill-Petshop Project

This is a multi-container application consisting of a Laravel backend and a Vue frontend, built using Docker for development and production environments. 

TRY THE WITHOUT DOCKER ROUTE FIRST

## Table of Contents

- [Project Structure](#project-structure)
- [Prerequisites](#prerequisites)
- [Setup Instructions](#setup-instructions)
  - [Development Environment](#development-environment)
    - [With Docker](#with-docker)
    - [Without Docker](#without-docker)
  - [Production Environment](#production-environment)
    - [With Docker](#with-docker-1)
    - [Without Docker](#without-docker-1)
- [Running Tests](#running-tests)

## Project Structure

buckhill-petshop-project/
├── backend/
│ ├── app/
│ ├── bootstrap/
│ ├── config/
│ ├── database/
│ ├── public/
│ ├── resources/
│ ├── routes/
│ ├── storage/
│ ├── tests/
│ ├── Dockerfile
│ ├── composer.json
│ ├── artisan
│ └── ...
├── frontend/
│ ├── src/
│ │ ├── assets/
│ │ ├── components/
│ │ ├── constant/
│ │ ├── server/
│ │ ├── utils/
│ │ ├── composables/
│ │ │ └── useCounterStore.ts
│ │ ├── views/
│ │ ├── App.vue
│ │ ├── main.ts
│ │ ├── shims-vue.d.ts
│ │ ├── index.css
│ │ └── ...
│ ├── Dockerfile


## Prerequisites

- Docker
- Docker Compose
- Node.js
- Yarn
- Composer

## Setup Instructions

### Development Environment

#### With Docker

1. **Navigate to the project root directory**:

    ```bash
    cd buckhill-petshop-project
    ```

2. **Run Docker Compose for Development**:

    ```bash
    docker-compose -f docker-compose.dev.yml up --build
    ```

3. **Access the Applications**:
    - Laravel application: Open your browser and navigate to `http://localhost:8000`.
    - Vue application: Open your browser and navigate to `http://localhost:3000`.

#### Without Docker

##### Laravel Backend

1. **Navigate to the backend directory**:

    ```bash
    cd buckhill-petshop-project/backend
    ```

2. **Install dependencies**:

    ```bash
    composer install
    ```

3. **Set up environment file**:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Run the development server**:

    ```bash
    php artisan serve --host=127.0.0.1 --port=8000
    ```

5. **Access the Laravel Application**:

    Open your browser and navigate to `http://127.0.0.1:8000`.

##### Vue Frontend

1. **Navigate to the frontend directory**:

    ```bash
    cd buckhill-petshop-project/frontend
    ```

2. **Install dependencies**:

    ```bash
    yarn install
    yarn add axios
    yarn add -D @types/axios
    ```

3. **Run the development server**:

    ```bash
    yarn dev
    ```

4. **Access the Vue Application**:

    Open your browser and navigate to `http://localhost:8080`.

### Production Environment

#### With Docker

1. **Navigate to the project root directory**:

    ```bash
    cd buckhill-petshop-project
    ```

2. **Run Docker Compose for Production**:

    ```bash
    docker-compose up --build
    ```

3. **Access the Applications**:
    - Laravel application: Open your browser and navigate to `http://localhost:8000`.
    - Vue application: Open your browser and navigate to `http://localhost:3000`.

#### Without Docker

##### Laravel Backend

1. **Navigate to the backend directory**:

    ```bash
    cd buckhill-petshop-project/backend
    ```

2. **Install dependencies**:

    ```bash
    composer install
    ```

3. **Set up environment file**:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Build the application** (if needed):

    ```bash
    # Run any necessary build commands, if any
    ```

5. **Serve the application**:

    ```bash
    php artisan serve --host=127.0.0.1 --port=8000
    ```

6. **Access the Laravel Application**:

    Open your browser and navigate to `http://127.0.0.1:8000`.

##### Vue Frontend

1. **Navigate to the frontend directory**:

    ```bash
    cd buckhill-petshop-project/frontend
    ```

2. **Install dependencies**:

    ```bash
    yarn install
    ```

3. **Build the application**:

    ```bash
    yarn build
    ```

4. **Serve the application using a static file server like `serve`**:

    ```bash
    yarn global add serve
    serve -s dist
    ```

5. **Access the Vue Application**:

    Open your browser and navigate to the URL provided by `serve`.

## Running Tests

To run tests for the Laravel application, use the following command:

```bash
cd buckhill-petshop-project/backend
php artisan test
