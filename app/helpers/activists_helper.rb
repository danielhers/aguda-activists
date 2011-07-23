module ActivistsHelper
  def activist_has_interest?(interest)
    if @activist
      @activist.interests.include?(interest)
    else
      false
    end
  end

  def add_interest_link(name, form)
    link_to_function name do |page|
      interest = render :partial => 'new_interest', :object => Interest.new,
        :locals => { :pf => form }
      page << %{
        var new_id = new Date().getTime();
        $('#interests').append("#{ escape_javascript interest }".replace(/new_interest/g, new_id))
      }
    end
  end
end
