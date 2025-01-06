## About Job Search Tracker

Job Search Tracker is a simple web application that you can run locally to easily keep track of your job applications during your job search journey, like saving the specific CV sent for a job, role description, interview information and expected salary, all while keeping track of dates for each step in the application process.


To run you will need to have the following dependencies installed:
- Docker
- PHP 8.x
- Node >= 18

Then to start up the mysql DB container that will store the application's data run the following command:

`docker compose up`

After the containers are up, start the application by running the *run_local* script with this command:

`sh ./run_local.sh`

You can now start using the application in your browser on http://localhost:8000/

## License

Job Search Tracker is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
