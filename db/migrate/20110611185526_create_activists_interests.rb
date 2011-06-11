class CreateActivistsInterests < ActiveRecord::Migration
  def self.up
    create_table :activists_interests, :id => false do |t|
      t.references :activist, :interest, :null => false, :unique => true
    end
  end

  def self.down
    drop_table :activists_interests
  end
end
