<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210103221350 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ordem_servico (id INT AUTO_INCREMENT NOT NULL, ordem_id INT DEFAULT NULL, descricao VARCHAR(255) NOT NULL, valor NUMERIC(15, 2) NOT NULL, INDEX IDX_844B572785E52AF1 (ordem_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ordem_servico ADD CONSTRAINT FK_844B572785E52AF1 FOREIGN KEY (ordem_id) REFERENCES ordem (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ordem_servico');
    }
}
