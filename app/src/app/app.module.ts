import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ReactiveFormsModule } from '@angular/forms';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import { MatButtonModule } from '@angular/material/button';
import { MatCardModule } from '@angular/material/card';
import { MatExpansionModule } from '@angular/material/expansion';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { MatIconModule } from '@angular/material/icon';
import { MatSelectModule } from '@angular/material/select';
import { MatSidenavModule } from '@angular/material/sidenav';
import { MatTableModule } from '@angular/material/table';
import { MatToolbarModule } from '@angular/material/toolbar';
import { HomeComponent } from './home/home.component';
import { WorkoutsComponent } from './workouts/workouts.component';
import { WorkoutDetailsComponent } from './workouts/workout-details/workout-details.component';
import { WorkoutExercisesComponent } from './workoutExercises/workoutExercises.component';
import { WorkoutExerciseDetailsComponent } from './workoutExercises/workoutExercise-details/workoutExercise-details.component';
import { ExercisesComponent } from './exercises/exercises.component';
import { ExerciseDetailsComponent } from './exercises/exercise-details/exercise-details.component';
import { SettingsComponent } from './settings/settings.component';

import { LoadingService } from './services/loading/loading.service';


@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    WorkoutsComponent,
    WorkoutDetailsComponent,
    WorkoutExercisesComponent,
    WorkoutExerciseDetailsComponent,
    ExercisesComponent,
    ExerciseDetailsComponent,
    SettingsComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MatButtonModule,
    MatCardModule,
    MatExpansionModule,
    MatFormFieldModule,
    MatIconModule,
    MatInputModule,
    MatSelectModule,
    MatSidenavModule,
    MatTableModule,
    MatToolbarModule,
    ReactiveFormsModule
  ],
  providers: [
    LoadingService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
