FROM node:20

WORKDIR /app

# Copia package.json para instalar dependências
COPY package*.json ./

RUN npm install

# Copia o restante do frontend
COPY . .

EXPOSE 8080

# Comando para rodar o Vue
CMD ["npm", "run", "serve", "--", "--host", "0.0.0.0"]
