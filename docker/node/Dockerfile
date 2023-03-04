FROM node:19-alpine


WORKDIR /app/ui


COPY ui/package*.json ./


RUN npm install

COPY . .

EXPOSE 3000

CMD ["npm","start"]