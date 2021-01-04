<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210104004951 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordem_servico ADD servico_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ordem_servico ADD CONSTRAINT FK_844B572782E14982 FOREIGN KEY (servico_id) REFERENCES servico (id)');
        $this->addSql('CREATE INDEX IDX_844B572782E14982 ON ordem_servico (servico_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordem_servico DROP FOREIGN KEY FK_844B572782E14982');
        $this->addSql('DROP INDEX IDX_844B572782E14982 ON ordem_servico');
        $this->addSql('ALTER TABLE ordem_servico DROP servico_id');
    }
}
