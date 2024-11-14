
# NeuroNation API Setup

This guide will walk you through setting up the NeuroNation API locally using Docker and how to make authenticated requests to the endpoints.

## Prerequisites

- Docker and Docker Compose installed on your machine.
- Git installed to clone the repository.

## Installation

1. **Clone the repository:**

   First, clone the repository to your local machine using the following command:

   ```bash
   git clone https://github.com/awwal1999/NeuroNation 
   ```

2. **Navigate into the project directory:**

   Change into the project directory:

   ```bash
   cd NeuroNation
   ```

3. **Run Docker Compose:**

   Start the application with Docker Compose in detached mode:

   ```bash
   docker-compose up -d
   ```

   This will spin up the required containers for the application, including the database and web server.

## Database Setup

1. **Run Migrations:**

   After the containers are up, run the migrations to set up the database:

   ```bash
   docker-compose run --rm artisan migrate
   ```

2. **Run Seeder:**

   Seed the database with the required data:

   ```bash
   docker-compose run --rm artisan db:seed
   ```

## Accessing the Application

The application should now be live on your local machine at:

```
http://localhost:80
```

## Making Requests

### 1. Login

To authenticate and receive a token, make a `POST` request to the `/api/login` endpoint with the following JSON payload:

```json
{
    "email": "not.a.fraudster@neuronation.com",
    "password": "password"
}
```

**Response:**

```json
{
    "token": "your_generated_token_here"
}
```

### 2. Get Session History

Once you have the token from the login response, use it to authenticate a request to the `/api/sessions/history` endpoint. Include the token in the `Authorization` header as a Bearer token.

**Example cURL Request:**

```bash
curl -X GET http://localhost/api/sessions/history -H "Authorization: Bearer your_generated_token_here"
```

**Sample Response:**

```json
{
    "success": true,
    "message": "Session history retrieved successfully.",
    "data": {
        "history": [
            {
                "score": 900,
                "date": 1729539642
            },
            {
                "score": 69,
                "date": 1726820873
            },
            {
                "score": 562,
                "date": 1723846937
            },
            {
                "score": 498,
                "date": 1723304863
            },
            {
                "score": 427,
                "date": 1721964232
            },
            {
                "score": 914,
                "date": 1719302824
            },
            {
                "score": 997,
                "date": 1718110256
            },
            {
                "score": 926,
                "date": 1717515430
            },
            {
                "score": 847,
                "date": 1715639742
            },
            {
                "score": 813,
                "date": 1715631079
            },
            {
                "score": 399,
                "date": 1715561864
            },
            {
                "score": 44,
                "date": 1712041810
            }
        ],
        "recently_trained": []
    }
}
```
