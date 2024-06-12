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
                sh 'sudo make stop-production'
                sh 'sudo make build-production'
            }
        }

        stage('Run') {
            steps {
                sh 'sudo make start-production'
            }
        }

        stage('Run') {
            steps {
                sh 'sudo make copy-env'
                sh 'sudo make key-generate'
                sh 'sudo make config-cache'
                sh 'sudo make route-cache'
            }
        }
    }
}
