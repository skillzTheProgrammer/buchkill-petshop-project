# Petshop Project

This is a Vue 3 application for a pet shop, built with Vite, TypeScript, Pinia, Tailwind CSS, and Vitest. 
This README file provides a comprehensive guide for setting up and running this project, including both development and production environments, with and without Docker, as well as running tests.


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

├── frontend/
│ ├── src/
│ │ ├── assets/
│ │ ├── components/
│ │ ├── stores/
│ │ │ └── useCounterStore.ts
│ │ ├── tests/
│ │ │ ├── setup.ts
│ │ │ └── HelloWorld.spec.ts
│ │ ├── views/
│ │ ├── App.vue
│ │ ├── main.ts
│ │ ├── shims-vue.d.ts
│ │ ├── index.css
│ │ └── ...
│ ├── Dockerfile
│ ├── docker-compose.yml
│ ├── docker-compose.dev.yml
│ ├── vite.config.ts
│ ├── tsconfig.json
│ ├── tsconfig.node.json
│ ├── tsconfig.app.json
│ ├── tailwind.config.js
│ ├── postcss.config.js
│ └── .dockerignore



## Prerequisites

- Docker
- Docker Compose
- Node.js
- Yarn

## Setup Instructions

### Development Environment

#### With Docker

1. **Navigate to the frontend directory**:

    ```bash
    cd petshop-project/frontend
    ```

2. **Run Docker Compose for Development**:

    ```bash
    docker-compose -f docker-compose.dev.yml up --build
    ```

3. **Access the Application**:

    Open your browser and navigate to `http://localhost:3000`.

#### Without Docker

1. **Navigate to the frontend directory**:

    ```bash
    cd petshop-project/frontend
    ```

2. **Install dependencies**:

    ```bash
    yarn install
    ```

3. **Run the development server**:

    ```bash
    yarn dev
    ```

4. **Access the Application**:

    Open your browser and navigate to `http://localhost:5173`.

### Production Environment

#### With Docker

1. **Navigate to the frontend directory**:

    ```bash
    cd petshop-project/frontend
    ```

2. **Run Docker Compose for Production**:

    ```bash
    docker-compose up --build
    ```

3. **Access the Application**:

    Open your browser and navigate to `http://localhost`.

#### Without Docker

1. **Navigate to the frontend directory**:

    ```bash
    cd petshop-project/frontend
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

5. **Access the Application**:

    Open your browser and navigate to the URL provided by `serve`.

## Running Tests

To run tests using Vitest, use the following command:

```bash
yarn test
