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
                sh 'docker-compose exec app php cp /var/www/.env.production.sample /var/www/.env'
                sh 'docker-compose exec app php artisan key:generate'
                sh 'docker-compose exec app php artisan config:cache'
                sh 'docker-compose exec app php artisan route:cache'
            }
        }
    }
}
