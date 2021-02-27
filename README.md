# AWS CloudFormation Tech Talk Project

This project was used in a tech talk I gave about Infrastructure as Code.
Inside the `/stacks` there are CloudFormation templates which will setup this entire project in AWS. It will also automatically setup CodePipeline and CodeBuild for CI/CD pipelines and automatic deployments.

This project is a simple photo upload page. You click upload in the top right, upload a photo, and it will appear on the main page. There is also a custom build Q&A section where people can post questions anonymously and also anonymously vote on questions to make them higher on the question board.

This project requires Pusher credentials for the best experience.
