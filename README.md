**NOTE:** This was an assessment task for an interview and is in no way a fully developed application. Please do not use the code as is.

## Simple Tasks

**Simple Tasks** is a task management application that allows users to manage and prioritize tasks with a drag-and-drop interface. The application also supports linking tasks to specific projects for better organization.

## Setup

### Download

To set up the project, start by cloning or downloading the repository from your preferred source.

### Configuration

1. **Environment Setup**:  
   After downloading the project, configure your database settings in the `.env` file. Make sure to update the following fields with your database details:
    ```env
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

### Database Migration

1. Open your command line interface.
2. Navigate to the root directory of the project.
3. Run the following command to migrate the database:
    ```bash
    php artisan migrate
    ```
4. Run database seeder:
    ```bash
    php artisan db:seed
    ```

## Running the Application

To start the application, run the following command in your command line:

```bash
php artisan serve
```

This will start the development server, and open the web browser and go to the url shown (usually http://127.0.0.1:8000).

## Usage

1. **Viewing Tasks**:  
   When you first open the website, the task list is displayed by default. The task list is paginated, showing 10 tasks per page. If there are more than 10 tasks, pagination links will appear below the table.

2. **Adding Projects**:  
   Before adding tasks, you should first create a project. Navigate to the Projects page and click the "Add Project" button.

3. **Adding Tasks**:  
   After creating a project, go back to the Tasks page and click "Add Task" to create a new task.

4. **Priority Assignment**:
    - If the Priority field on the task creation page is left empty, the next available priority level will be automatically assigned.
    - If you want to insert a task at a specific priority level, you can enter the priority (a number where the highest priority is 1 and the higher the priority number is the lower the priority). If the chosen priority number is more than 1 higher than the highest priority number already saved, it will be adjusted to the next available priority.

## Changing Task Priority

There are two ways to change the priority of a task:

1. **Drag and Drop**:  
   You can change the task's priority by dragging and dropping the task row in the table. After dropping, the new priority is automatically updated in the database, and the table is refreshed.

2. **Edit Task**:  
   Alternatively, you can change the priority by clicking the "Edit" button for a task and entering a priority number.

## Project Filter

To only show tasks for a specific project, use the project dropdown above the task table. Select the project to show that project.
