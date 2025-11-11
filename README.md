# AtomPHP

**AtomPHP** é um micro-framework PHP simples e eficiente, ideal para projetos pequenos e médios que precisam de uma base enxuta, organizada e funcional. O foco do AtomPHP é oferecer uma estrutura rápida para criação de aplicações web em PHP, com rotas, controllers, views e banco de dados de forma clara e objetiva.

## 🚀 Recursos

- Estrutura MVC básica (Model-View-Controller)
- Sistema simples de rotas
- Suporte a controllers e views
- Autoload de classes via PSR-4 (Composer)
- Configuração por arquivos `.env`
- Pronto para integração com banco de dados

## 📁 Estrutura do Projeto

```
atomphp/
├── app/
│   ├── controllers/
│   ├── models/
│   └── views/
├── core/
│   ├── App.php
│   ├── Controller.php
│   └── Route.php
├── public/
│   └── index.php
├── .env
├── composer.json
└── LICENSE
└── README.md
```

- **app/**: Contém o código da aplicação (controllers, models e views).
- **core/**: Contém o núcleo do framework, como roteamento e carregamento das classes.
- **public/**: Diretório público que contém o ponto de entrada da aplicação (`index.php`).
- **.env**: Arquivo de configuração com variáveis de ambiente.
- **composer.json**: Define dependências do projeto.

## 🧩 Requisitos

- PHP 7.4 ou superior
- Composer instalado globalmente

## 🔧 Instalação

Siga os passos abaixo para configurar o projeto localmente:

1. **Clone este repositório:**

```bash
git clone https://github.com/aldecirfonseca/atomphp.git
```

2. **Configure as variáveis de ambiente no arquivo `.env`.**  
   Altere as configurações conforme seu ambiente (ex: banco de dados, ambiente de desenvolvimento, etc).

3. **Rode o projeto com docker**

```bash
docker compose up --build
```

4. **Acesse sua aplicação no navegador:**

```
http://localhost:8000
```

5. **Faça login com o usuário admin**
```
email: administrador@gmail.com
senha: admin
```

## ▶️ Como Usar

- Toda requisição entra pelo `public/index.php`.
- As rotas são geradas com base nos controllers em `app/controllers/`.
- Os métodos dos controllers são chamados de acordo com a URL.
- As views são carregadas a partir de `app/views/`.

**Exemplo de URL:**

```
http://localhost/usuario/listar
```

Essa URL chamará o método `listar()` da classe `UsuarioController`.

