🚀 IntelliCard: Gerador de Cartões Anki 3D
O IntelliCard é uma ferramenta poderosa que transforma textos brutos em cartões de memorização (estilo Anki) de forma automatizada. Utilizando a inteligência artificial da GROQ, o sistema processa o conteúdo, gera perguntas e respostas pertinentes e as apresenta em uma interface web com animações 3D interativas.

✨ Funcionalidades
Processamento Inteligente: Converte qualquer texto em pares de Pergunta/Resposta.

Integração com GROQ: Velocidade ultra-rápida na geração de conteúdo via LLM.

Interface 3D: Cartões animados para uma experiência de estudo mais imersiva.

Fácil Cópia: Pronto para ser exportado ou utilizado diretamente na plataforma.

🛠️ Tecnologias Utilizadas
Framework: Laravel 11

IA Engine: GROQ Cloud API

Linguagem: PHP 8.2+

Frontend: Tailwind CSS / Three.js (ou sua biblioteca 3D de preferência)

⚙️ Instalação e Configuração
Siga os passos abaixo para rodar o projeto localmente:

Clone o repositório:

Bash
git clone https://github.com/seu-usuario/nome-do-projeto.git
cd nome-do-projeto
Instale as dependências:

Bash
composer install
npm install && npm run dev
Configure o ambiente:
Copie o arquivo de exemplo:

Bash
cp .env.example .env
Chave da API (Obrigatório):
Para que a geração de cartões funcione, você precisa de uma chave da GROQ.

Acesse o Groq Console.

Gere uma nova API Key.

No seu arquivo .env, adicione a seguinte linha:

⚠️ Importante:

Snippet de código
GROQ_API_KEY=sua_chave_aqui_projeto_anki
Gere a chave da aplicação e rode as migrações:

Bash
php artisan key:generate
php artisan migrate
