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
//                 sh 'sudo docker stop bot-berita'
//                 sh 'sudo docker rm bot-berita'
                sh 'sudo docker run -d --name laravel-dsp laravel-dsp:latest'
            }
        }
    }
}
