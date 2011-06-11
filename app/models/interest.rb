class Interest < ActiveRecord::Base
  validates :name, :presence => true

  has_and_belongs_to_many :activists, :uniq => true
end