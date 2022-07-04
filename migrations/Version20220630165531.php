<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630165531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE address_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contact_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contact_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_object_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_work_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_work_list_position_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE unit_of_measure_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE work_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE address (id INT NOT NULL, postal_code INT NOT NULL, region VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, area VARCHAR(255) NOT NULL, settlement VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, house INT NOT NULL, flat INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE contact (id INT NOT NULL, type_id INT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4C62E638C54C8C93 ON contact (type_id)');
        $this->addSql('CREATE TABLE contact_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE project (id INT NOT NULL, customer_id INT NOT NULL, status_id INT NOT NULL, name VARCHAR(255) NOT NULL, comment VARCHAR(1024) NOT NULL, work_start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, work_end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_complete BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE9395C3F3 ON project (customer_id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE6BF700BD ON project (status_id)');
        $this->addSql('CREATE TABLE project_address (project_id INT NOT NULL, address_id INT NOT NULL, PRIMARY KEY(project_id, address_id))');
        $this->addSql('CREATE INDEX IDX_9B5063E4166D1F9C ON project_address (project_id)');
        $this->addSql('CREATE INDEX IDX_9B5063E4F5B7AF75 ON project_address (address_id)');
        $this->addSql('CREATE TABLE project_object (id INT NOT NULL, project_id INT NOT NULL, name VARCHAR(255) NOT NULL, comment VARCHAR(1024) NOT NULL, area VARCHAR(1024) NOT NULL, work_start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, work_end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_complete BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BF0940A6166D1F9C ON project_object (project_id)');
        $this->addSql('CREATE TABLE project_object_address (project_object_id INT NOT NULL, address_id INT NOT NULL, PRIMARY KEY(project_object_id, address_id))');
        $this->addSql('CREATE INDEX IDX_E4B7DB83321113FC ON project_object_address (project_object_id)');
        $this->addSql('CREATE INDEX IDX_E4B7DB83F5B7AF75 ON project_object_address (address_id)');
        $this->addSql('CREATE TABLE project_status (id INT NOT NULL, name VARCHAR(255) NOT NULL, is_in_work BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE project_work_list (id INT NOT NULL, project_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, comment VARCHAR(2056) NOT NULL, is_coordinated_by_customer BOOLEAN NOT NULL, is_coordinated_by_master BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AC370CF7166D1F9C ON project_work_list (project_id)');
        $this->addSql('COMMENT ON COLUMN project_work_list.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE project_work_list_position (id INT NOT NULL, work_list_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, amount DOUBLE PRECISION NOT NULL, total DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CECE50C0E865AEA9 ON project_work_list_position (work_list_id)');
        $this->addSql('CREATE TABLE unit_of_measure (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE work_type (id INT NOT NULL, measure_id INT NOT NULL, name VARCHAR(255) NOT NULL, default_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_751DE6115DA37D00 ON work_type (measure_id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638C54C8C93 FOREIGN KEY (type_id) REFERENCES contact_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE9395C3F3 FOREIGN KEY (customer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE6BF700BD FOREIGN KEY (status_id) REFERENCES project_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_address ADD CONSTRAINT FK_9B5063E4166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_address ADD CONSTRAINT FK_9B5063E4F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_object ADD CONSTRAINT FK_BF0940A6166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_object_address ADD CONSTRAINT FK_E4B7DB83321113FC FOREIGN KEY (project_object_id) REFERENCES project_object (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_object_address ADD CONSTRAINT FK_E4B7DB83F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_work_list ADD CONSTRAINT FK_AC370CF7166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_work_list_position ADD CONSTRAINT FK_CECE50C0E865AEA9 FOREIGN KEY (work_list_id) REFERENCES project_work_list (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_type ADD CONSTRAINT FK_751DE6115DA37D00 FOREIGN KEY (measure_id) REFERENCES unit_of_measure (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD company_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD registration_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE project_address DROP CONSTRAINT FK_9B5063E4F5B7AF75');
        $this->addSql('ALTER TABLE project_object_address DROP CONSTRAINT FK_E4B7DB83F5B7AF75');
        $this->addSql('ALTER TABLE contact DROP CONSTRAINT FK_4C62E638C54C8C93');
        $this->addSql('ALTER TABLE project_address DROP CONSTRAINT FK_9B5063E4166D1F9C');
        $this->addSql('ALTER TABLE project_object DROP CONSTRAINT FK_BF0940A6166D1F9C');
        $this->addSql('ALTER TABLE project_work_list DROP CONSTRAINT FK_AC370CF7166D1F9C');
        $this->addSql('ALTER TABLE project_object_address DROP CONSTRAINT FK_E4B7DB83321113FC');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EE6BF700BD');
        $this->addSql('ALTER TABLE project_work_list_position DROP CONSTRAINT FK_CECE50C0E865AEA9');
        $this->addSql('ALTER TABLE work_type DROP CONSTRAINT FK_751DE6115DA37D00');
        $this->addSql('DROP SEQUENCE address_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contact_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contact_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_object_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_work_list_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_work_list_position_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE unit_of_measure_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE work_type_id_seq CASCADE');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE contact_type');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_address');
        $this->addSql('DROP TABLE project_object');
        $this->addSql('DROP TABLE project_object_address');
        $this->addSql('DROP TABLE project_status');
        $this->addSql('DROP TABLE project_work_list');
        $this->addSql('DROP TABLE project_work_list_position');
        $this->addSql('DROP TABLE unit_of_measure');
        $this->addSql('DROP TABLE work_type');
        $this->addSql('ALTER TABLE "user" DROP company_name');
        $this->addSql('ALTER TABLE "user" DROP registration_date');
    }
}
