FROM node:19-alpine


COPY ui/package.json ./
COPY ui/package-lock.json ./

RUN npm install

EXPOSE 3000

CMD ["npm","start"]