CREATE DATABASE IF NOT EXISTS bancolink CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bancolink;

DROP TABLE IF EXISTS interacoes;
DROP TABLE IF EXISTS noticias;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
  usuarioID INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  sexo CHAR(1) NOT NULL,
  telefone VARCHAR(15) NOT NULL UNIQUE,
  cpf VARCHAR(14) NOT NULL UNIQUE,
  jornalista TINYINT(1) NOT NULL DEFAULT 0
);

INSERT INTO usuarios (nome, email, senha, sexo, telefone, cpf, jornalista) VALUES
('Joana Silva', 'joana@example.com', '123456', 'F', '11999999999', '123.456.789-00', 1),
('Carlos Alberto', 'carlos@example.com', 'abcdef', 'M', '11888888888', '987.654.321-11', 0);

CREATE TABLE noticias (
  noticiaID INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(150) NOT NULL,
  descricao TEXT NOT NULL,
  texto TEXT NOT NULL,
  foto VARCHAR(255),
  usuarioID INT NOT NULL,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_noticia_usuario FOREIGN KEY (usuarioID) REFERENCES usuarios(usuarioID) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO noticias (titulo, descricao, texto, foto, usuarioID, data_criacao) VALUES
('Gato é flagrado bocejando', 'Um momento adorável capturado no instante de um bocejo felino.', 'O gato boceja de maneira fofa e espontânea, encantando os internautas com sua expressão.', 'gago2.png', 1, '2025-07-08 09:17:25'),
('VOID', 'VOID', 'VOID', 'gagov2.png', 1, '2025-07-08 09:33:14'),
('Tecnologia Neuralink avança', 'Novas descobertas em interface cérebro-máquina.', 'Detalhes sobre os recentes avanços da Neuralink e suas aplicações práticas.', 'gago2.png', 1, '2025-07-08 10:00:00'),
('Inteligência Artificial na medicina', 'Como a IA está revolucionando diagnósticos.', 'Uma análise detalhada das aplicações da IA em hospitais e clínicas.', 'gagov2.png', 1, '2025-07-08 10:30:00'),
('Exploração espacial', 'Novas missões a Marte planejadas para 2030.', 'Agências espaciais internacionais unem forças para nova era de exploração.', 'gago2.png', 1, '2025-07-08 11:00:00'),
('Sustentabilidade urbana', 'Cidades adotam energia renovável.', 'Iniciativas para tornar centros urbanos mais verdes e eficientes.', 'gagov2.png', 1, '2025-07-08 11:30:00'),
('Cibersegurança em alta', 'Aumenta a proteção contra ataques digitais.', 'Empresas investem em tecnologias para proteger dados sensíveis.', 'gago2.png', 1, '2025-07-08 12:00:00'),
('Veículos elétricos', 'Mercado cresce com novas opções.', 'Modelos inovadores chegam às ruas com maior autonomia.', 'gagov2.png', 1, '2025-07-08 12:30:00'),
('Robótica doméstica', 'Assistentes inteligentes ganham popularidade.', 'Novos robôs facilitam tarefas diárias em casa.', 'gago2.png', 1, '2025-07-08 13:00:00'),
('Realidade Virtual', 'Imersão total em ambientes digitais.', 'Avanços em VR prometem experiências revolucionárias.', 'gagov2.png', 1, '2025-07-08 13:30:00'),
('Energia solar', 'Painéis mais eficientes para residências.', 'Novas tecnologias permitem maior captação de energia solar.', 'gago2.png', 1, '2025-07-08 14:00:00'),
('Biotecnologia', 'Avanços no tratamento genético.', 'Novas técnicas prometem curas para doenças hereditárias.', 'gagov2.png', 1, '2025-07-08 14:30:00'),
('Educação online', 'Plataformas inovadoras ganham espaço.', 'Transformação digital no ensino em tempos modernos.', 'gago2.png', 1, '2025-07-08 15:00:00'),
('Mudanças climáticas', 'Impactos e soluções globais.', 'Discussão sobre o futuro do planeta e ações urgentes.', 'gagov2.png', 1, '2025-07-08 15:30:00'),
('Ciência de dados', 'Big Data e análise preditiva.', 'Como dados estão mudando a forma de tomar decisões.', 'gago2.png', 1, '2025-07-08 16:00:00');

CREATE TABLE interacoes (
  usuarioID INT NOT NULL,
  noticiaID INT NOT NULL,
  data_interacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (usuarioID, noticiaID),
  CONSTRAINT fk_interacao_usuario FOREIGN KEY (usuarioID) REFERENCES usuarios(usuarioID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_interacao_noticia FOREIGN KEY (noticiaID) REFERENCES noticias(noticiaID) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO interacoes (usuarioID, noticiaID, data_interacao) VALUES
(1, 1, '2025-07-08 09:17:25');
