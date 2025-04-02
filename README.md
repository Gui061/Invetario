# Documentação do Sistema de Inventário

## 1. Introdução

### a. Qual o objetivo da atividade?
Este projeto tem como objetivo implementar um sistema de inventário para um jogo, permitindo que os jogadores adicionem e visualizem itens armazenados de maneira organizada.

#### i. O que é um inventário em um jogo? Qual a finalidade? Dê exemplos.
Um inventário em um jogo é um sistema que permite armazenar, gerenciar e visualizar itens coletados pelo jogador ao longo da partida. Exemplos incluem o inventário de "The Legend of Zelda", onde o jogador armazena armas, poções e chaves, e o inventário de "Minecraft", onde os jogadores armazenam blocos, ferramentas e outros recursos.

#### ii. Que tipos de sistemas utilizam essa funcionalidade? Dê exemplos.
Sistemas de inventário são amplamente utilizados em:
- **Jogos de RPG** (ex.: "The Witcher 3", "Skyrim")
- **Jogos de sobrevivência** (ex.: "Minecraft", "The Forest")
- **Jogos de tiro** (ex.: "Call of Duty", "Counter-Strike")
- **Jogos de aventura** (ex.: "The Legend of Zelda", "Tomb Raider")

#### iii. Por que essa funcionalidade é importante?
A funcionalidade de inventário é essencial para permitir que os jogadores gerenciem seus recursos, organizem seus itens e melhorem a experiência de jogo, evitando perda de itens e facilitando a estratégia do jogador.

## 2. A Implementação

### a. Front-end

#### i. Quais ferramentas foram utilizadas (editores/linguagens)? Por quê? O que cada um deles faz?
- **HTML**: Estrutura a interface do inventário e os formulários.
- **CSS (via Bootstrap)**: Garante um design responsivo e visual atraente.
- **JavaScript (caso necessário)**: Pode ser usado para interatividade.
- **Editor de Código (ex.: VS Code)**: Utilizado para desenvolvimento e edição do código-fonte.

#### ii. Como o layout foi definido? Como a interface foi setorizada? Relação linhas x colunas.
- **Setorização**:
  - Um container principal que organiza os elementos centrais.
  - Uma área de login.
  - Uma seção que exibe os itens do inventário.
  - Um formulário para adição de novos itens.
- **Relação linhas x colunas**:
  - Usa Bootstrap para responsividade.
  - Cada item do inventário é mostrado em um card com imagem e quantidade.

### b. Back-end

#### i. Quais ferramentas foram utilizadas (editores/linguagens)? Por quê? O que cada um deles faz?
- **PHP**: Responsável pelo processamento dos dados e gestão do inventário.
- **Arquivo de texto (`inventario.txt`)**: Utilizado como banco de dados simples para armazenar os itens.
- **Sessão PHP (`session_start()`)**: Gerencia autenticação do usuário.

#### ii. Sobre o código PHP

##### 1. O que o código faz? Explicar as principais funcionalidades com exemplos de código.

- **Autenticação de usuário:**
  ```php
  define('USERNAME', 'zelda');
  define('PASSWORD', '1234');
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['login'])) {
          if ($_POST['username'] == USERNAME && $_POST['password'] == PASSWORD) {
              $_SESSION['logado'] = true;
              header('Location: index.php');
              exit;
          }
      }
  }
  ```
  Esse trecho verifica o login do usuário e inicia uma sessão caso os dados estejam corretos.

- **Leitura do inventário:**
  ```php
  function lerInventario() {
      $itens = [];
      if (file_exists('inventario.txt')) {
          $arquivo = fopen('inventario.txt', 'r');
          while ($linha = fgets($arquivo)) {
              $itens[] = trim($linha);
          }
          fclose($arquivo);
      }
      return $itens;
  }
  ```
  Essa função abre o arquivo `inventario.txt`, lê os itens e os retorna em um array.

- **Adição de um novo item:**
  ```php
  function adicionarItem($item) {
      $arquivo = fopen('inventario.txt', 'a');
      fwrite($arquivo, $item . PHP_EOL);
      fclose($arquivo);
  }
  ```
  Essa função adiciona um novo item ao arquivo de inventário.

## 3. Passo a Passo de Execução

### a. Explicar o que deve ser feito para executar o projet!
o
1. Ter um servidor local instalado (ex.: XAMPP, WAMP, ou LAMP).
2. Colocar os arquivos do projeto na pasta `htdocs` (XAMPP) ou equivalente.
3. Iniciar o servidor Apache.
4. Acessar `http://localhost/index.php` no navegador.
5. Fazer login com `zelda` e `1234`.
6. Adicionar itens ao inventário através do formulário.

### b. Explicar a hierarquia de diretórios do projeto
```
/inventario_zelda/
├── index.php       # Arquivo principal do sistema
├── inventario.txt  # Arquivo que armazena os itens
├── styles.css      # Arquivo CSS para customização (opcional)
└── assets/         # Pasta para imagens e recursos (opcional)
```

![Captura de tela 2025-04-02 093158](https://github.com/user-attachments/assets/0128fd32-c211-443d-b39f-6c23fa99d6c4)


