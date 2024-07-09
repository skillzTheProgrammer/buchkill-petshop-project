# Stage 1: Build the Vue.js application
FROM node:16 as build-stage

WORKDIR /app

COPY package*.json ./
RUN yarn install

COPY . .

RUN yarn build

# Stage 2: Serve the application using http-server
FROM node:16 as production-stage

WORKDIR /app

COPY --from=build-stage /app/dist /app/dist

RUN yarn global add http-server

EXPOSE 8080

CMD ["http-server", "dist"]
