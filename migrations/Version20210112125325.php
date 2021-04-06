<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210112125325 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE creature (id INT AUTO_INCREMENT NOT NULL, id_size_id INT NOT NULL, id_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, challenge SMALLINT NOT NULL, alignment VARCHAR(255) NOT NULL, INDEX IDX_2A6C6AF497100157 (id_size_id), INDEX IDX_2A6C6AF41BD125E3 (id_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creature_source (creature_id INT NOT NULL, source_id INT NOT NULL, INDEX IDX_CAA7F10F9AB048 (creature_id), INDEX IDX_CAA7F10953C1C61 (source_id), PRIMARY KEY(creature_id, source_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creature_size (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, hit_dice SMALLINT NOT NULL, square_space SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creature_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE creature ADD CONSTRAINT FK_2A6C6AF497100157 FOREIGN KEY (id_size_id) REFERENCES creature_size (id)');
        $this->addSql('ALTER TABLE creature ADD CONSTRAINT FK_2A6C6AF41BD125E3 FOREIGN KEY (id_type_id) REFERENCES creature_type (id)');
        $this->addSql('ALTER TABLE creature_source ADD CONSTRAINT FK_CAA7F10F9AB048 FOREIGN KEY (creature_id) REFERENCES creature (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE creature_source ADD CONSTRAINT FK_CAA7F10953C1C61 FOREIGN KEY (source_id) REFERENCES source (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE creature_source DROP FOREIGN KEY FK_CAA7F10F9AB048');
        $this->addSql('ALTER TABLE creature DROP FOREIGN KEY FK_2A6C6AF497100157');
        $this->addSql('ALTER TABLE creature DROP FOREIGN KEY FK_2A6C6AF41BD125E3');
        $this->addSql('ALTER TABLE creature_source DROP FOREIGN KEY FK_CAA7F10953C1C61');
        $this->addSql('DROP TABLE creature');
        $this->addSql('DROP TABLE creature_source');
        $this->addSql('DROP TABLE creature_size');
        $this->addSql('DROP TABLE creature_type');
        $this->addSql('DROP TABLE source');
    }
}
