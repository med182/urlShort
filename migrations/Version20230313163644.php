<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313163644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create the table Urls';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8AA6989F2F727085 ON urls (original)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8AA6989F78B5DC1 ON urls (shortened)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8AA6989F2F727085 ON Urls');
        $this->addSql('DROP INDEX UNIQ_8AA6989F78B5DC1 ON Urls');
    }
}
