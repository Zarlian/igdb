# Game Review Platform (IMDb for Games)

## Description

This project is a full-stack web application developed using **Laravel** for the backend and **Vue.js** for the frontend. It allows users to explore, review, and manage video games, similar to IMDb but focused on the gaming world. The platform provides a dynamic interface where users can interact with games, rate them, and maintain personalized lists, while administrators have full control over game data, user management, and reviews.

This project challenged me to implement complex features such as user authentication, data management, and responsive design, delivering a highly interactive and functional web application.

## Features

### User-Side
- Browse and search for video games.
- View detailed game information and reviews.
- Rate games and add them to personalized lists.
- Discover new games based on preferences.

### Admin-Side
- Full CRUD operations for managing games, developers, and companies.
- JWT-based authentication for secure access.
- User management system to handle reviews and interactions.

## Technologies Used

### Frontend
- **Vue.js**: Built user and admin interfaces.
- **HTML5** and **CSS3**: For page structure and design.
- **JavaScript**: For dynamic functionality.

### Backend
- **Laravel**: Built the API for handling data operations.
- **MySQL**: Used for data management.
- **JWT Authentication**: To secure user and admin access.

### Others
- **Responsive Design**: Ensures compatibility with mobile devices.

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/yourusername/game-review-platform.git
    ```

2. Navigate to the project directory:

    ```bash
    cd game-review-platform
    ```

3. Install dependencies:

    **Frontend:**

    ```bash
    cd frontend
    npm install
    ```

    **Backend:**

    ```bash
    cd backend
    composer install
    ```

4. Set up the database and configure the `.env` file in the Laravel project.

5. Run the project:

    **Backend:**

    ```bash
    php artisan serve
    ```

    **Frontend:**

    ```bash
    npm run dev
    ```

## Usage

- Navigate to the homepage to browse or search for video games.
- Users can sign up or log in to rate games and add them to their lists.
- Admins can log in to access the dashboard and manage game listings, reviews, and users

## Lessons Learned

This project helped me dive deeper into the backend architecture with Laravel, particularly focusing on routing, controllers, and database interactions. It was also my first hands-on experience with Vue.js, and despite the learning curve, I was able to build a responsive and interactive interface. Implementing JWT authentication was a highlight, providing a strong security layer for user and admin interactions.
