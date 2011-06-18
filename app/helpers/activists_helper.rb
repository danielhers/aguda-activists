module ActivistsHelper
  def activist_has_interest?(interest)
    if @activist
      @activist.interests.include?(interest)
    else
      false
    end
  end
end
