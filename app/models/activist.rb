require 'email_validator'

class Activist < ActiveRecord::Base
  validates :first_name, :last_name, :email, :presence => true
  validates :age,   :numericality => {:allow_nil => true,
                                      :greater_than_or_equal_to => 0}
  validates :phone, :format => {:with => /[\d-]*/},
                    :uniqueness => {:allow_nil => true}
  validates :email, :email => {:if => :email?},
                    :uniqueness => {:case_sensitive => false}

  has_and_belongs_to_many :interests, :uniq => true
  accepts_nested_attributes_for :interests, :reject_if => lambda { |i| i[:name].blank? }, :allow_destroy => true
end
