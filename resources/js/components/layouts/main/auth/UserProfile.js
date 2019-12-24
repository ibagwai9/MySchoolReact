import React from 'react';
import PropTypes from 'prop-types';
import { withStyles } from '@material-ui/core/styles'
import { Grid, Paper, Avatar,Typography,  CardContent } from '@material-ui/core'
import { connect } from 'react-redux'
import { userActions } from '../../../../actions' 
import logo from '../../../../images/logo.png'
import PostCard from '../PostCard'
import ProfileHeader from '../ProfileHeader'
import AppBar from '../AppBar'

class UserProfile extends React.Component{
    constructor(props) {
        super(props)
        
          this.state = {
             authenticated: false
         }
         console.log(this.props)
    }   
    
   componentDidMount() {
        this.props.dispatch(userActions.getAuth())
        const user = localStorage.getItem('user')
        console.log({props:this.props, user})
    }

    render(){
            const { user, users, className, classes } = this.props
        return (
          <div> <AppBar />
        <Paper className={className}> 
            <CardContent>
                <div className={classes.root}>
   
    <div className={classes.main}>
      <ProfileHeader
        className={classes.header}
        displayName="Brandon Folks"
        bio="Professional photographer"
        coverUrl="https://source.unsplash.com/collection/841904"
        avatarUrl="https://source.unsplash.com/collection/895539"
        stats={{
          posts: 112,
          followers: 234,
          following: 22,
        }}
      />

      <Grid container>
        <Grid item xs={12} sm={6} md={4}>
          <PostCard
            title="Spicy Carrot Salad"
            subtitle="@Anna posted 1 hour ago"
            imageUrl="https://source.unsplash.com/L1ZhjK-R6uc/1600x900"
            avatarUrl="https://source.unsplash.com/b1Hg7QI-zcc/150x150"
            body="Because this salad is so simple, fresh, top-quality tomatoes and mozzarella are important"
          />
        </Grid>
        <Grid item xs={12} sm={6} md={4}>
          <PostCard
            title="Burrata Black Bean Burgers"
            subtitle="@Sandra posted 3 days ago"
            imageUrl="https://source.unsplash.com/sWq83ZbZb6U/1600x900"
            avatarUrl="https://source.unsplash.com/EGVccebWodM/150x150"
            body="These vegetarian burgers are delicious! Your carnivorous friends will be impressed. My favorite way to serve is on a whole-wheat..."
          />
        </Grid>
        <Grid item xs={12} sm={6} md={4}>
          <PostCard
            title="Vegan Shepherd's Pie"
            subtitle="@Janne posted 1 week ago"
            imageUrl="https://source.unsplash.com/l_DY1GYtjTo/1600x900"
            avatarUrl="https://source.unsplash.com/yl2rJVuNWFQ/150x150"
            body="Looks yummy, but not very healthy at all. I'll try leaving out the vegan mayo and cream cheese. I think I might try it with soaked..."
          />
        </Grid>
        <Grid item xs={12} sm={6} md={4}>
          <PostCard
            title="Rice cake eggs"
            subtitle="@James posted 2 weeks ago"
            imageUrl="https://source.unsplash.com/kZeUekYF9Jw/1600x900"
            avatarUrl="https://source.unsplash.com/d2MSDujJl2g/150x150"
            body="When you've got the whole gang along for the camping trip, make breakfast eggs the easy way and enjoy a slow sip of your coffee..."
          />
        </Grid>
      </Grid>
    </div>
  </div>
            </CardContent>
        </Paper>
        </div>)
    }   
}
const styles = theme => ({
    form: {
        display: 'flex',
        flexDirection: 'column',
    },
    submitButton: {
        marginTop: 24,
    },
    container: {
        width: '100%'
    },
    logo: {
        width: 100,
        height:100
    },
    logoContainer:{
        textAlign:'center',
    },
    clearBtn:{
        float:'right'
    }
})

UserProfile.propTypes = {
  classes: PropTypes.objectOf(PropTypes.string),
  className: PropTypes.string,
}

const mapStateToProps = (state)=> {
    const { users, authentication } = state
    let user = {}
    if(authentication)
      user = authentication.user

    return  {
        user,
        users
    } 
}

const connectedUserProfile = connect(mapStateToProps)(UserProfile);

export default withStyles(styles)(connectedUserProfile)
