FROM node:lts-alpine

WORKDIR /usr/src/app

COPY package*.json ./

RUN npm install --only=production

COPY docker/node .

EXPOSE 3000

CMD [ "node", "server.js" ]
