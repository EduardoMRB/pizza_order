CREATE TABLE pizza_order (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  sabor VARCHAR(50) NOT NULL,
  preco FLOAT NOT NULL,
  descricao TEXT,
  disponivel TINYINT NOT NULL
) Engine=InnoDB;
