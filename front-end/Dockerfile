FROM node:18

# Configuração do diretório de trabalho
WORKDIR /app

# Instalar dependências
COPY package*.json ./
RUN npm install

# Copiar código para o container
COPY . .

# Expor porta
EXPOSE 3000
