Gold Grid App

Overview
Gold Grid App is a student management system designed to help administrators manage student data efficiently. It includes both a front-end interface and a back-end infrastructure that work together to provide features such as user management, dashboards, and time stamping. The app communicates with the back-end through APIs and stores data in a DynamoDB table.

Front-End
- Dashboard: A user-friendly interface for viewing and managing student information.
- Create New Users: Add new students or administrators to the system.
- Time Stamp: Record and manage time entries for various events or actions.

Back-End
- DynamoDB Table: The app's back-end includes a DynamoDB table for securely storing and managing student data.
- API Communication: Front-end and back-end communicate via APIs, handling data requests and updates.

 AWS Services Used
- AWS Elastic Container Registry (ECR): To store and manage Docker container images for deployment.
- AWS Lambda: For executing back-end functions such as API requests.
- AWS DynamoDB: A fast, fully managed NoSQL database to store student data.
- AWS API Gateway: To create and manage APIs that allow the front end to communicate with the back end.
- AWS CloudWatch: For monitoring and logging the performance of the app.
- AWS IAM: To manage access control for various AWS services used by the app.





Prerequisites
To get started with the Gold Grid App, you'll need:
- An AWS account
- Docker installed
- Python 3.x installed
- Git for version control

Installation
1. Clone the repository from GitHub:
    git clone https://github.com/your-repo/Gold-Grid-App.git
    cd Gold-Grid-App
2. Set up your Python environment:
3. Build and run the Docker containers:

AWS Deployment Steps:
1. Build Docker Image
2. Push Docker Image to AWS ECR

AWS Configuration
1. Create a DynamoDB Table:
   - Define the necessary attributes (e.g., StudentID, UserInfo).
2. Set up AWS API Gateway:
   - Create REST APIs for communication between the front-end and back-end.
3. Configure AWS Lambda:
   - Use Lambda functions for handling specific back-end logic (Post and Get).



4. Monitor via CloudWatch:
   - Set up CloudWatch for logging and monitoring the performance of your app.
