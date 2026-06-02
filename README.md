<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
# Loja do Zeca

Projeto Laravel 12 para gerenciamento de materiais de construção, com cadastro de categorias, cadastro de materiais, upload de imagens e controle visual de estoque.

> Projeto desenvolvido por Henry Domingues.

## Descrição

Loja do Zeca é uma aplicação web construída em Laravel 12 que oferece:

- CRUD completo para categorias e materiais
- Upload de imagem para cada material
- Detecção de imagens muito grandes com aviso no formulário
- Aviso visual em vermelho quando o estoque está abaixo do mínimo
- Aviso visual em amarelo quando o estoque está exatamente no mínimo
- Exibição de materiais em cards com todos os campos importantes
- Exibição de "Não se aplica" quando a validade estiver em branco

## Versões utilizadas

### Backend
- PHP `^8.2`
- Laravel `^12.0`
- Laravel Breeze `^2.4`
- Laravel Tinker `^2.10.1`

### Frontend
- Node.js: recomendado `>=18`
- Vite `^7.0.7`
- Tailwind CSS `^3.1.0`
- Alpine.js `^3.4.2`
- Axios `^1.11.0`
- @tailwindcss/forms `^0.5.2`
- laravel-vite-plugin `^2.0.0`

## Requisitos

- PHP `8.2` ou superior
- Composer
- Node.js `>=18`
- npm
- Servidor web local (XAMPP, Laravel Sail, Valet, etc.)

## Instalação passo a passo

1. Acesse a pasta do projeto:

```bash
cd c:\xampp\htdocs\loja-do-zeca
```

2. Instale as dependências PHP:

```bash
composer install
```

3. Instale as dependências JavaScript:

```bash
npm install
```

4. Copie o arquivo de ambiente:

```bash
copy .env.example .env
```

5. Gere a chave da aplicação:

```bash
php artisan key:generate
```

6. Configure o banco de dados no arquivo `.env`.

7. Execute as migrations:

```bash
php artisan migrate
```

8. Crie o link simbólico para storage:

```bash
php artisan storage:link
```

9. Inicie o servidor de desenvolvimento:

```bash
php artisan serve
```

10. Inicie o servidor de assets:

```bash
npm run dev
```

11. Abra a aplicação em:

```text
http://127.0.0.1:8000
```

## Comandos úteis

- Rodar testes:

```bash
php artisan test
```

- Compilar assets para produção:

```bash
npm run build
```

- Limpar cache de views:

```bash
php artisan view:clear
```

## Observações

- As imagens de materiais são armazenadas em `storage/app/public/materiais`.
- O projeto já contém lógica para exibir avisos de estoque baixo e de estoque no mínimo.
- Quando o campo `data_validade` está vazio, a interface mostra `Não se aplica`.

## Autor

Henry Domingues

---

Documentação criada para orientar a instalação e uso do projeto Loja do Zeca, respeitando as versões notificadas em `composer.json` e `package.json`.
