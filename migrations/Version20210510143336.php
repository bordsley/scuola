<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510143336 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tables');
        $this->addSql('ALTER TABLE fixed_menu DROP FOREIGN KEY fixedmenu-restaurant');
        $this->addSql('DROP INDEX fixedmenu-restaurant ON fixed_menu');
        $this->addSql('ALTER TABLE fixed_menu CHANGE total_price total_price NUMERIC(9, 2) NOT NULL');
        $this->addSql('ALTER TABLE fixed_menu_food ADD CONSTRAINT FK_97F6A30664132EB4 FOREIGN KEY (id_food_id) REFERENCES food (id)');
        $this->addSql('ALTER TABLE fixed_menu_food ADD CONSTRAINT FK_97F6A3065ACBFD1 FOREIGN KEY (id_fixed_menu_id) REFERENCES fixed_menu (id)');
        $this->addSql('CREATE INDEX IDX_97F6A30664132EB4 ON fixed_menu_food (id_food_id)');
        $this->addSql('CREATE INDEX IDX_97F6A3065ACBFD1 ON fixed_menu_food (id_fixed_menu_id)');
        $this->addSql('ALTER TABLE food CHANGE timeout timeout DATETIME DEFAULT NULL, CHANGE osc osc TINYINT(1) NOT NULL, CHANGE ingredients ingredients VARCHAR(200) NOT NULL, CHANGE description description VARCHAR(200) NOT NULL, CHANGE second_price second_price NUMERIC(9, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F77DA963AD FOREIGN KEY (id_section_id) REFERENCES section (id)');
        $this->addSql('CREATE INDEX IDX_D43829F77DA963AD ON food (id_section_id)');
        $this->addSql('ALTER TABLE `order` CHANGE prezzo_totale prezzo_totale NUMERIC(9, 2) DEFAULT NULL, CHANGE note_aggiuntive note_aggiuntive VARCHAR(255) DEFAULT NULL, CHANGE is_complited is_complited TINYINT(1) NOT NULL, CHANGE pay_type pay_type INT DEFAULT NULL');
        $this->addSql('ALTER TABLE owner CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFFCFA10B FOREIGN KEY (id_restaurant_id) REFERENCES restaurant_info (id)');
        $this->addSql('CREATE INDEX IDX_2D737AEFFCFA10B ON section (id_restaurant_id)');
        $this->addSql('DROP INDEX food_suborder_idx ON sub_order');
        $this->addSql('DROP INDEX order_suborder_idx ON sub_order');
        $this->addSql('ALTER TABLE sub_order CHANGE quantita quantita INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tables (id_restaurant INT NOT NULL, codice_tavolo VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX restaurant_tables_idx (id_restaurant)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tables ADD CONSTRAINT restaurant_tables FOREIGN KEY (id_restaurant) REFERENCES restaurant_info (ID)');
        $this->addSql('ALTER TABLE fixed_menu CHANGE total_price total_price NUMERIC(7, 2) NOT NULL');
        $this->addSql('ALTER TABLE fixed_menu ADD CONSTRAINT fixedmenu-restaurant FOREIGN KEY (id_restaurant) REFERENCES restaurant_info (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX fixedmenu-restaurant ON fixed_menu (id_restaurant)');
        $this->addSql('ALTER TABLE fixed_menu_food DROP FOREIGN KEY FK_97F6A30664132EB4');
        $this->addSql('ALTER TABLE fixed_menu_food DROP FOREIGN KEY FK_97F6A3065ACBFD1');
        $this->addSql('DROP INDEX IDX_97F6A30664132EB4 ON fixed_menu_food');
        $this->addSql('DROP INDEX IDX_97F6A3065ACBFD1 ON fixed_menu_food');
        $this->addSql('ALTER TABLE food DROP FOREIGN KEY FK_D43829F77DA963AD');
        $this->addSql('DROP INDEX IDX_D43829F77DA963AD ON food');
        $this->addSql('ALTER TABLE food CHANGE timeout timeout DATE DEFAULT NULL, CHANGE osc osc TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE description description VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ingredients ingredients VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE second_price second_price NUMERIC(7, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE prezzo_totale prezzo_totale NUMERIC(7, 2) DEFAULT NULL, CHANGE note_aggiuntive note_aggiuntive VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT \'""\' COLLATE `utf8mb4_unicode_ci`, CHANGE pay_type pay_type INT UNSIGNED DEFAULT NULL, CHANGE is_complited is_complited TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE owner CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEFFCFA10B');
        $this->addSql('DROP INDEX IDX_2D737AEFFCFA10B ON section');
        $this->addSql('ALTER TABLE sub_order CHANGE quantita quantita INT DEFAULT 0 NOT NULL');
        $this->addSql('CREATE INDEX food_suborder_idx ON sub_order (id_cibo)');
        $this->addSql('CREATE INDEX order_suborder_idx ON sub_order (id_ordine)');
    }
}
