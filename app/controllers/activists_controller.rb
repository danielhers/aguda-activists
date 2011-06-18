class ActivistsController < ApplicationController
  # GET /activists
  # GET /activists.xml
  def index
    @activists = Activist.all

    respond_to do |format|
      format.html # index.html.erb
      format.xml  { render :xml => @activists }
    end
  end

  # GET /activists/1
  # GET /activists/1.xml
  def show
    @activist = Activist.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.xml  { render :xml => @activist }
    end
  end

  # GET /activists/new
  # GET /activists/new.xml
  def new
    @activist = Activist.new
    @interests = Interest.all

    # 1 pre-built interest
    #1.times {@activist.interests.build}

    respond_to do |format|
      format.html # new.html.erb
      format.xml  { render :xml => @activist }
    end
  end

  # GET /activists/1/edit
  def edit
    @activist = Activist.find(params[:id])
    @interests = Interest.all
  end

  # POST /activists
  # POST /activists.xml
  def create
    @activist = Activist.new(params[:activist])
    @interests = Interest.all

    respond_to do |format|
      if @activist.save
        format.html { redirect_to(@activist, :notice => 'Activist was successfully created.') }
        format.xml  { render :xml => @activist, :status => :created, :location => @activist }
      else
        format.html { render :action => "new" }
        format.xml  { render :xml => @activist.errors, :status => :unprocessable_entity }
      end
    end
  end

  # PUT /activists/1
  # PUT /activists/1.xml
  def update
    @activist = Activist.find(params[:id])
    @interests = Interest.all

    respond_to do |format|
      if @activist.update_attributes(params[:activist])
        format.html { redirect_to(@activist, :notice => 'Activist was successfully updated.') }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @activist.errors, :status => :unprocessable_entity }
      end
    end
  end

  # DELETE /activists/1
  # DELETE /activists/1.xml
  def destroy
    @activist = Activist.find(params[:id])
    @activist.destroy
    
    respond_to do |format|
      format.html { redirect_to(activists_url) }
      format.xml  { head :ok }
    end
  end
end
