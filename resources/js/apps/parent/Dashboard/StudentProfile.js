import React from 'react';
import clsx from 'clsx';
import { makeStyles } from '@material-ui/core/styles';
import List from '@material-ui/core/List';
import {Typography, 
    CardContent, 
    Container,
    Link,
    Grid,
    Paper
} from '@material-ui/core';
import AppBarMain from './AppBarMain'
import Students from'./Students'
import Orders from'./Orders'

import ProfileHeader from '../../../components/layouts/main/ProfileHeader'

function Copyright() {                                                   
  return (
    <Typography variant="body2" color="textSecondary" align="center">
      {'Copyright © '}
      <Link color="inherit" href="/">
        BGWSchools
      </Link>{' '}
      {new Date().getFullYear()}
      {'.'}
    </Typography>
  );
}
 
const drawerWidth = 240;

const useStyles = makeStyles(theme => ({
  root: {
    display: 'flex',
  },
  toolbar: {
    paddingRight: 24, // keep right padding when drawer closed
  },
 
  appBarSpacer: theme.mixins.toolbar,
  content: {
    flexGrow: 1,
    height: '100vh',
    overflow: 'auto',
  },
  paper: {
    padding: theme.spacing(2),
    display: 'flex',
    overflow: 'auto',
    flexDirection: 'column',
  },
  fixedHeight: {
    height: 240,
  },
}));

export default function StudentProfile({child}) {
  const classes = useStyles();
  let myChildren = []

  let student = child
  let img = null
  let user = student
  if(user && user.userable){
    myChildren = user.userable.students
  }
  const renderStudent = ()=>{
    if(child){
      const img = child.profile_pix
      return(<CardContent>
          <ProfileHeader
            className={classes.header}
            displayName={user.name}
            bio={user.username}
            coverUrl="https://source.unsplash.com/collection/841904"
            avatarUrl={`student_photo/${img}`}
            data={{val:['Junior secondary','3','2019/2020'],
              item:['School','Class','Session']}}
          />
        </CardContent>)
    }else{
      return <div>N/A</div>
    }
  }
 const fixedHeightPaper = clsx(classes.paper, classes.fixedHeight);
  return (
    <div className={classes.root}>
      
    <AppBarMain />
      <main className={classes.content}>
        <div className={classes.appBarSpacer} />
        {renderStudent()}
        <Container maxWidth="lg" className={classes.container}>
          <Grid container spacing={3}>
            
            {/* Recent Orders */}
            <Grid item xs={12}>
              <Paper className={classes.paper}>
                <Orders/>
              </Paper>
            </Grid>
          </Grid>
        </Container>
        <Copyright />
      </main>
    </div>
  );
}
