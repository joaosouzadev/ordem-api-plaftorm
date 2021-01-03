<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210103152903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, celular VARCHAR(255) DEFAULT NULL, cep VARCHAR(255) DEFAULT NULL, rua VARCHAR(255) DEFAULT NULL, numero VARCHAR(255) DEFAULT NULL, complemento VARCHAR(255) DEFAULT NULL, bairro VARCHAR(255) DEFAULT NULL, cidade VARCHAR(255) DEFAULT NULL, INDEX IDX_F41C9B25A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B25A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cliente');
    }
}
