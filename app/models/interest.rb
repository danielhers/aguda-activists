class Interest < ActiveRecord::Base
  validates :name, :presence => true, :uniqueness => true

  attr_accessible :name

  has_and_belongs_to_many :activists, :uniq => true
end
