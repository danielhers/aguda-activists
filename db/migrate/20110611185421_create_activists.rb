class CreateActivists < ActiveRecord::Migration
  def self.up
    create_table :activists do |t|
      t.string :first_name
      t.string :last_name
      t.integer :age
      t.string :phone
      t.string :email

      t.timestamps
    end
  end

  def self.down
    drop_table :activists
  end
end
