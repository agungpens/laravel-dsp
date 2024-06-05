pipeline {
    agent {
        node {
            label 'dsp'
        }
    }

    triggers {
        pollSCM('* * * * *')
    }

    options {
        disableConcurrentBuilds()
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Build') {
            steps {
                sh 'sudo docker build -t laravel-dsp:latest .'
            }
        }

        stage('Run') {
            steps {
//                 sh 'sudo docker stop laravel-dsp'
//                 sh 'sudo docker rm laravel-dsp'
                sh 'sudo docker run -d --name laravel-dsp -p 1234:1234 laravel-dsp:latest'
            }
        }
    }
}
